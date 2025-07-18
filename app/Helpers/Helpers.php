<?php

use App\Models\Group;
use App\Models\Product;

if (!function_exists('allChildGroup', )) {
    function allChildGroup($group, $processedGroups = [])
    {
        if (in_array($group->id, $processedGroups)) {
            return '<li>Обнаружена циклическая ссылка: ' . $group->name . '</li>';
        }

        $processedGroups[] = $group->id;

        $childGroups = Group::where('parent_id', $group->id)->get();
        $hasChildren = $childGroups->isNotEmpty();

        $html = '<li class="position-relative">';

        $childId = [];
        $childId = childId($group, $childId);

        $productsCount = Product::whereIn('id_group', $childId)->get()->count();

        if ($hasChildren) {

            $html .= '<div class="d-flex align-items-center">'
                . '<a href="' . route('main', ['groupId' => $group->id]) . '" class="flex-grow-1">' . $group->name . "(".$productsCount.")".'</a>'
                . '<span class="toggle-icon ms-2" data-bs-toggle="collapse" data-bs-target="#group-' . $group->id . '">+</span>'
                . '</div>';
        } else {
            $html .= '<a href="' . route('main', ['groupId' => $group->id]) . '">' . $group->name . "(".$productsCount.")".'</a>';
        }

        if ($hasChildren) {
            $html .= '<ul class="collapse list-unstyled ps-3" id="group-' . $group->id . '">';
            foreach ($childGroups as $childGroup) {
                $html .= allChildGroup($childGroup, $processedGroups);
            }
            $html .= '</ul>';
        }

        return $html . '</li>';
    }

}
if (!function_exists('childId', )) {
    function childId($group, $processedGroups)
    {
        $childGroups = Group::where('parent_id', $group->id)->get();
        $hasChildren = $childGroups->isNotEmpty();
        array_push($processedGroups, $group->id);

        if ($hasChildren) {
            foreach ($childGroups as $childGroup) {
                $processedGroups = childId($childGroup, $processedGroups);
            }
        }

        return $processedGroups;
    }

}

