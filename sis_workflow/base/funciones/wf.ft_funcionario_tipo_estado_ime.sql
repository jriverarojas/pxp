CREATE OR REPLACE FUNCTION "wf"."ft_funcionario_tipo_estado_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Work Flow
 FUNCION: 		wf.ft_funcionario_tipo_estado_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'wf.tfuncionario_tipo_estado'
 AUTOR: 		 (admin)
 FECHA:	        15-03-2013 16:19:04
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:

 DESCRIPCION:	
 AUTOR:			
 FECHA:		
***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_funcionario_tipo_estado	integer;
			    
BEGIN

    v_nombre_funcion = 'wf.ft_funcionario_tipo_estado_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'WF_FUNCTEST_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		15-03-2013 16:19:04
	***********************************/

	if(p_transaccion='WF_FUNCTEST_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into wf.tfuncionario_tipo_estado(
			id_labores_tipo_proceso,
			id_tipo_estado,
			id_funcionario,
			id_depto,
			estado_reg,
			fecha_reg,
			id_usuario_reg,
			id_usuario_mod,
			fecha_mod
          	) values(
			v_parametros.id_labores_tipo_proceso,
			v_parametros.id_tipo_estado,
			v_parametros.id_funcionario,
			v_parametros.id_depto,
			'activo',
			now(),
			p_id_usuario,
			null,
			null
							
			)RETURNING id_funcionario_tipo_estado into v_id_funcionario_tipo_estado;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Funcionarios x Tipo Estado almacenado(a) con exito (id_funcionario_tipo_estado'||v_id_funcionario_tipo_estado||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_funcionario_tipo_estado',v_id_funcionario_tipo_estado::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'WF_FUNCTEST_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		15-03-2013 16:19:04
	***********************************/

	elsif(p_transaccion='WF_FUNCTEST_MOD')then

		begin
			--Sentencia de la modificacion
			update wf.tfuncionario_tipo_estado set
			id_labores_tipo_proceso = v_parametros.id_labores_tipo_proceso,
			id_tipo_estado = v_parametros.id_tipo_estado,
			id_funcionario = v_parametros.id_funcionario,
			id_depto = v_parametros.id_depto,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now()
			where id_funcionario_tipo_estado=v_parametros.id_funcionario_tipo_estado;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Funcionarios x Tipo Estado modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_funcionario_tipo_estado',v_parametros.id_funcionario_tipo_estado::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'WF_FUNCTEST_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		15-03-2013 16:19:04
	***********************************/

	elsif(p_transaccion='WF_FUNCTEST_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from wf.tfuncionario_tipo_estado
            where id_funcionario_tipo_estado=v_parametros.id_funcionario_tipo_estado;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Funcionarios x Tipo Estado eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_funcionario_tipo_estado',v_parametros.id_funcionario_tipo_estado::varchar);
              
            --Devuelve la respuesta
            return v_resp;

		end;
         
	else
     
    	raise exception 'Transaccion inexistente: %',p_transaccion;

	end if;

EXCEPTION
				
	WHEN OTHERS THEN
		v_resp='';
		v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
		v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
		v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
		raise exception '%',v_resp;
				        
END;
$BODY$
LANGUAGE 'plpgsql' VOLATILE
COST 100;
ALTER FUNCTION "wf"."ft_funcionario_tipo_estado_ime"(integer, integer, character varying, character varying) OWNER TO postgres;