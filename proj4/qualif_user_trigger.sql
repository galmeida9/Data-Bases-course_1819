DROP TRIGGER IF EXISTS qualif_user_trigger ON utilizador_qualificado;
DROP FUNCTION IF EXISTS qualif_user_trigger_proc();

CREATE FUNCTION qualif_user_trigger_proc() RETURNS trigger 
AS $$
BEGIN
    IF EXISTS (
        SELECT email
        FROM utilizador_regular 
        WHERE email=NEW.email
    ) THEN
        RAISE EXCEPTION 'email não pode figurar em utilizador_regular.';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER qualif_user_trigger
BEFORE INSERT ON utilizador_qualificado
FOR EACH ROW 
EXECUTE PROCEDURE qualif_user_trigger_proc();
