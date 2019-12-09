DROP TRIGGER IF EXISTS reg_user_trigger ON utilizador_regular;
DROP FUNCTION IF EXISTS reg_user_trigger_proc();

CREATE FUNCTION reg_user_trigger_proc() RETURNS trigger 
AS $$
BEGIN
    IF EXISTS (
        SELECT email
        FROM utilizador_qualificado 
        WHERE email=NEW.email
    ) THEN
        RAISE EXCEPTION 'email não pode figurar em utilizador_qualificado.';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER reg_user_trigger
BEFORE INSERT ON utilizador_regular
FOR EACH ROW 
EXECUTE PROCEDURE reg_user_trigger_proc();
