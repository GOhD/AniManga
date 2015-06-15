   delimiter $$
   CREATE TRIGGER trig_rating_check BEFORE update ON my_Character 
	for each row 
    begin
    if NEW.Rating < 0 then 
    set NEW.Rating=0;
	end if;
    end$$
    
    
    