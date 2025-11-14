<?php

namespace App\Services;

use App\Models\UserPropertyInteraction;
use App\Models\Property;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    public function getRankedProperties()
{
    return Property::select([
            'properties.id',
            'properties.property_name',
            'properties.price',
            'properties.rooms',
            'properties.parking',
            'properties.furnished',
            'properties.tenant',
            'properties.utilities',
            'properties.contact_number',
            'properties.types',
            'properties.map_link',
            'properties.status',
            'properties.message',
            'properties.landlord_id',
            'properties.created_at',
            'properties.updated_at',
            DB::raw('
                SUM(CASE WHEN user_property_interactions.interaction_type = "view" THEN 1 ELSE 0 END) 
                + SUM(CASE WHEN user_property_interactions.interaction_type = "search" THEN 0.5 ELSE 0 END) 
                as interactions_count'
            ),
        ])
        ->leftJoin('user_property_interactions', 'properties.id', '=', 'user_property_interactions.property_id')
        ->where('properties.status', 'approved')
        ->groupBy(
            'properties.id',
            'properties.property_name',
            'properties.price',
            'properties.rooms',
            'properties.parking',
            'properties.furnished',
            'properties.tenant',
            'properties.utilities',
            'properties.contact_number',
            'properties.types',
            'properties.map_link',
            'properties.status',
            'properties.message',
            'properties.landlord_id',
            'properties.created_at',
            'properties.updated_at'
        )
        ->orderByDesc('interactions_count')
        ->get();
}

}

