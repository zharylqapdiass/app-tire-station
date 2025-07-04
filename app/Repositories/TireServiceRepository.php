<?php

namespace App\Repositories;

use App\Models\TireService;

class TireServiceRepository
{
    /**
     * @param array $filters
     * @return mixed
     */
    public function  search(array $filters)
    {
        $roomConditions = [];

        foreach ([1, 2, 3] as $room) {
            if (isset($filters["room_$room"]) && !empty($filters["room_$room"] && $filters["room_$room"]  == 'true')) {
                $roomConditions[] = $room;
            }
        }

        $query = TireService::query()
            ->select('*')
            ->selectRaw('
        (CASE
            WHEN name = ? THEN 3
            WHEN name LIKE ? THEN 2
            WHEN name LIKE ? THEN 1
            ELSE 0
        END) +
        (CASE WHEN room_count IN (' . implode(',', array_fill(0, count($roomConditions), '?')) . ') THEN 1 ELSE 0 END) +
        (CASE WHEN area > ? THEN 1 ELSE 0 END) +
        (CASE WHEN area < ? THEN 1 ELSE 0 END) AS relevance
    ', array_merge(
                [$filters['name'] ?? ''],
                [($filters['name'] ?? '') . '%'],
                ['%' . ($filters['name'] ?? '') . '%'],
                $roomConditions,
                [$filters['fromArea'] ?? 0, $filters['toArea'] ?? 999999]
            ));

        if (!empty($filters['name'])) {
            $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['hasImage'])) {
            $query->whereNotNull('image_path');
        }

        if (!empty($roomConditions)) {
            $query->whereIn('room_count', $roomConditions);
        }

        if (!empty($filters['fromArea'])) {
            $query->where('area', '>', $filters['fromArea']);
        }

        if (!empty($filters['toArea'])) {
            $query->where('area', '<', $filters['toArea']);
        }
        $query->orderByDesc('relevance')->orderByDesc('id');


        return $query;

    }
}
