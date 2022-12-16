ALTER TABLE cc_countries 
    ADD language varchar(50),
    ADD example_team_id int,


UPDATE cc_countries SET language='en', example_team_id=41 WHERE id=1