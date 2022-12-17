<?php

class CountriesPage extends Kirby\Cms\Page
{
    public function children()
    {
        $countries = [];

        foreach (Db::select('cc_countries') as $country)
        {
            $countries[] = [
                'template' => 'country',
                'slug' => Str::slug($country->name()),
                'model'    => 'country',  
                'num' =>   $country->id(),      
                'content' => [
                    'id' => $country->id(),
                    'title'    => $country->name() ?? 'New Country',
                    'language' => $country->language(),
                    'example_team_id' => $country->example_team_id,
                ]
            ];
        }

        return Pages::factory($countries, $this);
    }
}
