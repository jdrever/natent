<?php

class challengesPage extends Kirby\Cms\Page
{
    public function children()
    {
        $challenges = [];

        foreach (Db::select('cc_challenges') as $challenge)
        {
            $challenges[] = [
                'template' => 'challenge',
                'slug' => Str::slug($challenge->name()),
                'model'    => 'challenge',  
                'num' =>   $challenge->id(),      
                'content' => [
                    'challengeId' => $challenge->id(),
                    'title'    => $challenge->name() ?? 'New challenge',
                    'description' => $challenge->description(),
                    'further_information' => $challenge->further_information(),
                ]
            ];
        }

        return Pages::factory($challenges, $this);
    }
}
