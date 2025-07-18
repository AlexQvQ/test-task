<?php

use App\Models\Group;

if (!function_exists('productGroup', )) {
    function productGroup($product, $processedGroups = [])
    {
        $groupID = $product->id_group;
        $html = "";
        $processedGroups = [];
        $html = "<li class=\"breadcrumb-item\">" . $product->name . "</li>" . $html;

        while ($groupID != 0 && !in_array($groupID, $processedGroups)) {

            $group = Group::findOrFail($groupID);
            $html = "<li class=\"breadcrumb-item\"><a href=\"". route('main', ['groupId' => $groupID]) ."\">" . $group->name . "</a></li>" . $html;

            $processedGroups[] = $groupID;
            $groupID = $group->id_parent;

        }

        return $html;
    }

}
