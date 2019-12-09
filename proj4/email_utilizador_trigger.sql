DROP TRIGGER IF EXISTS email_utilizador_trigger ON utilizador;
DROP FUNCTION IF EXISTS email_utilizador_trigger_proc();

CREATE FUNCTION email_utilizador_trigger_proc() RETURNS trigger 
AS $$
BEGIN
    IF NOT EXISTS (
        SELECT email
        FROM utilizador_qualificado 
        WHERE email='NEW.email'
    ) AND NOT EXISTS (
        SELECT email
        FROM utilizador_regular           
        WHERE email='NEW.email'
    ) THEN
        RAISE EXCEPTION 'email de utilizador tem de figurar em utilizador_qualificado ou utilizador_regular.';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER email_utilizador_trigger
BEFORE INSERT ON utilizador
FOR EACH ROW 
EXECUTE PROCEDURE email_utilizador_trigger_proc();
