<?php

class CountryPage extends Kirby\Cms\Page
{

    public function changeTitle(string $title, string $languageCode = null)
    {

        if ($country = Db::first('cc_countries', '*', ['id' => $this->countryId()])) {
            if (Db::update('cc_countries', ['name' => $title], ['id' => $this->countryId()])) {
                return $this;
            };
        }
        return $this;
    }

    public function writeContent(array $data, string $languageCode = null): bool
    {

        if ($country = Db::first('cc_countries', '*', ['id' => $this->content()->countryId()])) 
        {
            //echo('1='.$this->content()->countryId());
            if (isset($data['title'])) unset($data['title']);
            return Db::update('cc_countries', $data, ['id' => $this->content()->countryId()]);
            //echo('3='.$this->content()->countryId());
        } 
        else
        {
            if ($this->content()->countryId()->isNotEmpty()) return Db::insert('cc_countries', ['name'=>$data['title']] );
        }
        return true;

    }
    public function delete(bool $force = false): bool
    {
        return Db::delete('cc_countries', ['id' => $this->content()->countryId()]);
    }


}