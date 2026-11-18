USE casoestudio;

DROP PROCEDURE IF EXISTS sp_registrar_ejercicio;
DELIMITER //
CREATE PROCEDURE sp_registrar_ejercicio(
    IN p_identificacion VARCHAR(15),
    IN p_monto DECIMAL(18,2),
    IN p_tipo INT
)
BEGIN
    DECLARE v_cantidad INT DEFAULT 0;
    DECLARE v_tipo INT DEFAULT 0;

    SELECT COUNT(*) INTO v_tipo
    FROM tiposejercicio
    WHERE TipoEjercicio = p_tipo;

    IF v_tipo = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'TIPO_NO_VALIDO';
    END IF;

    SELECT COUNT(*) INTO v_cantidad
    FROM ejercicios
    WHERE Identificacion = p_identificacion;

    IF v_cantidad >= 2 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'LIMITE_SOLICITUDES';
    END IF;

    INSERT INTO ejercicios (Identificacion, Fecha, Monto, TipoEjercicio)
    VALUES (p_identificacion, NOW(), p_monto, p_tipo);
END//
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_consultar_ejercicios;
DELIMITER //
CREATE PROCEDURE sp_consultar_ejercicios()
BEGIN
    SELECT e.Identificacion, e.Fecha, e.Monto,
           t.DescripcionTipoEjercicio
    FROM ejercicios e
    INNER JOIN tiposejercicio t
        ON e.TipoEjercicio = t.TipoEjercicio
    ORDER BY e.Fecha DESC, e.Consecutivo DESC;
END//
DELIMITER ;
