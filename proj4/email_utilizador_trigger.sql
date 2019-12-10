DROP TRIGGER IF EXISTS email_utilizador_trigger ON utilizador;
DROP FUNCTION IF EXISTS email_utilizador_trigger_proc();

CREATE FUNCTION email_utilizador_trigger_proc() RETURNS trigger 
AS $email_utilizador_trigger_proc$
BEGIN
    IF NOT EXISTS (
        SELECT email
        FROM utilizador_qualificado 
        WHERE email=NEW.email
    ) AND NOT EXISTS (
        SELECT email
        FROM utilizador_regular           
        WHERE email=NEW.email
    ) THEN
        RETURN NULL;
    END IF;
    RETURN NEW;
END;
$email_utilizador_trigger_proc$ LANGUAGE plpgsql;

CREATE TRIGGER email_utilizador_trigger
AFTER INSERT ON utilizador
FOR EACH ROW 
EXECUTE PROCEDURE email_utilizador_trigger_proc();
