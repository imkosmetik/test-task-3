<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

class SeedController extends Controller
{
    /**
     * Команда для засеивания каталога данными
     * @param int $groupCount Количество корневых групп для генерации
     * @param int $levels Уровень вложенности каталога. Товары могут лежать только в нижних уровнях
     * @param int $powNum Основание для получения количества групп на каждом уровне по формуле:
     *                    КОЛИЧЕСТВО_КОРНЕВЫХ_ГРУПП * ОСНОВАНИЕ^УРОВЕНЬ
     * @param int $itemCount
     * @return int Exit code
     */
    public function actionSeedCatalog(
        int $groupCount = 20,
        int $levels = 4,
        int $powNum = 5,
        int $itemCount = 100000
    ): int
    {
        $faker = \Faker\Factory::create();

        $this->stdout("Старт создания категорий.\n");

        $groupData = [];
        $parentIds = [0];
        $groupId = 0;
        for ($i = 0; $i < $levels; $i++) {
            $newParentIds = [];
            for ($j = 0; $j <= $groupCount * $powNum ** $i; $j++) {
                $groupData[] = [
                    'id' => ++$groupId,
                    'parent_id' => $parentIds[array_rand($parentIds)],
                    'name' => rtrim($faker->sentence(3), '.'),
                ];
                $newParentIds[] = $groupId;
            }
            $parentIds = $newParentIds;
        }

        $this->stdout("Конец создания категорий.\n");
        $this->stdout("Старт создания товаров.\n");

        $itemData = [];
        for ($i = 0; $i < $itemCount; $i++) {
            $itemData[] = [
                'group_id' => $parentIds[array_rand($parentIds)],
                'name' => rtrim($faker->sentence(2), '.'),
                'marking' =>  $faker->unique()->numberBetween(100000000, 999999999),
                'rating' => $faker->biasedNumberBetween(0, 1000) / 100,
            ];
        }

        $this->stdout("Конец создания товаров.\n");

        \Yii::$app->db
            ->createCommand()
            ->batchInsert('group', ['id', 'parent_id', 'name'], $groupData)
            ->execute();
        \Yii::$app->db
            ->createCommand()
            ->batchInsert('item', ['group_id', 'name', 'marking', 'rating'], $itemData)
            ->execute();

        return ExitCode::OK;
    }
}
