CREATE OR REPLACE FUNCTION pxp.f_delete_testructura_gui (
  par_codigo_gui varchar,
  par_codigo_gui_fk varchar
)
RETURNS varchar AS
$body$
DECLARE
	v_id_gui integer;
    v_id_gui_fk integer;
BEGIN
	select id_gui into v_id_gui
    from segu.tgui g
    where g.codigo_gui = par_codigo_gui;
    
    select id_gui into v_id_gui_fk
    from segu.tgui g
    where g.codigo_gui = par_codigo_gui_fk;
       
    update segu.testructura_gui set estado_reg = 'inactivo'
    where id_gui = v_id_gui and fk_id_gui = v_id_gui_fk 
          and estado_reg = 'activo';
    return 'exito';

END;
$body$
LANGUAGE 'plpgsql'
VOLATILE
CALLED ON NULL INPUT
SECURITY INVOKER
COST 100;