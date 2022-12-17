<?php

class ChallengePage extends Kirby\Cms\Page
{

    public function changeTitle(string $title, string $languageCode = null)
    {

        if ($challenge = Db::first('cc_challenges', '*', ['id' => $this->content()->id()])) {
            if (Db::update('cc_challenges', ['name' => $title], ['id' => $this->content()->id()])) {
                return $this;
            };
        }
        return $this;
    }

    public function writeContent(array $data, string $languageCode = null): bool
    {
        if ($challenge = Db::first('cc_challenges', '*', ['id' => $this->content()->id()] )) 
        {
            if (isset($data['title'])) unset($data['title']);
            if (isset($data['id'])) unset($data['id']);
            if (isset($data['uuid'])) unset($data['uuid']);
            if (empty($data['area_id'])) $data['area_id']='0';
            if (empty($data['area_id2'])) $data['area_id2']='0';
            if (empty($data['area_id3'])) $data['area_id3']='0';
            if (empty($data['country_id'])) $data['country_id']='0';
            return Db::update('cc_challenges', $data, ['id' => $this->content()->id()]);
        } 
        else
        {
            return Db::insert('cc_challenges', ['name'=>$data['title'], 'area_id'=>0] );
        }
        return true;

    }
    public function delete(bool $force = false): bool
    {
        return Db::delete('cc_challenges', ['id' => $this->content()->id()]);
    }


}