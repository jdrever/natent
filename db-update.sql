ALTER TABLE cc_countries 
    ADD language varchar(50),
    ADD example_team_id int,


UPDATE cc_countries SET language='en', example_team_id=41 WHERE id=1

CREATE TABLE cc_areas_translations (area_id int, language_code varchar(5), name varchar(100), description varchar(250))
