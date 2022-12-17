<?php

class CountryPage extends Kirby\Cms\Page
{

    public function changeTitle(string $title, string $languageCode = null)
    {

        if ($country = Db::first('cc_countries', '*', ['id' => $this->id()])) {
            if (Db::update('cc_countries', ['name' => $title], ['id' => $this->id()])) {
                return $this;
            };
        }
        return $this;
    }

    public function writeContent(array $data, string $languageCode = null): bool
    {

        if ($country = Db::first('cc_countries', '*', ['id' => $this->content()->id()])) 
        {
            if (isset($data['title'])) unset($data['title']);
            return Db::update('cc_countries', $data, ['id' => $this->content()->id()]);
        } 
        else
        {
            return Db::insert('cc_countries', ['name'=>$data['title']] );
        }
        return true;

    }
    public function delete(bool $force = false): bool
    {
        return Db::delete('cc_countries', ['id' => $this->content()->id()]);
    }


}