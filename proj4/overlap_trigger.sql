DROP TRIGGER IF EXISTS overlap_trigger ON anomalia_traducao;
DROP FUNCTION IF EXISTS overlap_trigger_proc();

CREATE FUNCTION overlap_trigger_proc() RETURNS trigger
AS $overlap_trigger_proc$
DECLARE
	zona box;
BEGIN
	SELECT anomalia.zona INTO zona FROM anomalia WHERE id=NEW.id;
    IF (zona && NEW.zona2) THEN
        RAISE EXCEPTION 'A segunda zona não se pode sobrepor à primeira.';
    END IF;
    RETURN NEW;
END;
$overlap_trigger_proc$ LANGUAGE plpgsql;

CREATE TRIGGER overlap_trigger
BEFORE INSERT ON anomalia_traducao
FOR EACH ROW 
EXECUTE PROCEDURE overlap_trigger_proc();
