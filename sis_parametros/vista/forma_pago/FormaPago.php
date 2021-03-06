<?php
/**
*@package pXP
*@file gen-FormaPago.php
*@author  (maylee.perez)
*@date 11-06-2019 20:56:48
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.FormaPago=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.FormaPago.superclass.constructor.call(this,config);
		this.init();
        // this.iniciarEventos();
		this.load({params:{start:0, limit:this.tam_pag}})
	},

	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_forma_pago'
			},
			type:'Field',
			form:true 
		},

        {
            config:{
                name: 'desc_forma_pago',
                fieldLabel: 'Forma de Pago',
                allowBlank: false,
                anchor: '80%',
                gwidth: 100,
                maxLength:100
            },
            type:'TextField',
            filters:{pfiltro:'fp.desc_forma_pago',type:'string'},
            id_grupo:1,
            grid:true,
            form:true
        },

        {
            config:{
                name: 'tipo',
                fieldLabel: 'Tipo',
                anchor: '80%',
                gwidth: 170,
                allowBlank: false,
                typeAhead: true,
                triggerAction: 'all',
                lazyRender:true,
                mode: 'local',
                valueField: 'inicio',
                forcSselect:true,
                enableMultiSelect: true,
                store:['Gasto','Ingreso']
            },
            type:'ComboBox',
            filters:{pfiltro:'fp.tipo',type:'string'},
            id_grupo:1,
            grid:true,
            form:true
        },

        {
            config:{
                name: 'codigo',
                fieldLabel: 'Código',
                qtip:'Código Libro de Bancos',
                allowBlank: false,
                anchor: '80%',
                gwidth: 100,
                maxLength:20
            },
            type:'TextField',
            filters:{pfiltro:'fp.codigo',type:'string'},
            id_grupo:1,
            grid:true,
            form:true
        },
        {
            config:{
                name: 'cod_inter',
                fieldLabel: 'Cód. Internacionales',
                qtip:'Cod. de Forma de Pago para internacionales',
                anchor: '80%',
                gwidth: 170,
                allowBlank: false,
                typeAhead: true,
                triggerAction: 'all',
                lazyRender:true,
                mode: 'local',
                valueField: 'inicio',
                forcSselect:true,
                enableMultiSelect: true,
                store:['BOL','BUE','MIA','SAO','MAD']
            },
            type:'AwesomeCombo',
            filters:{pfiltro:'fp.cod_inter',type:'string'},
            id_grupo:1,
            grid:true,
            form:true
        },
        {
            config:{
                name: 'orden',
                fieldLabel: 'Orden',
                qtip: 'Posición en la Ordenación',
                allowBlank: false,
                allowDecimals: true,
                anchor: '80%',
                gwidth: 100
            },
            type:'NumberField',
            filters: { pfiltro:'fp.orden', type:'numeric' },
            valorInicial: 1.00,
            id_grupo:1,
            grid:true,
            form:true
        },
        {
            config:{
                name: 'observaciones',
                fieldLabel: 'Observaciones',
                allowBlank: true,
                anchor: '80%',
                gwidth: 100,
                maxLength:300
            },
            type:'TextField',
            filters:{pfiltro:'fp.observaciones',type:'string'},
            id_grupo:1,
            grid:true,
            form:true
        },
        {
			config:{
				name: 'estado_reg',
				fieldLabel: 'Estado Reg.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:10
			},
				type:'TextField',
				filters:{pfiltro:'`fp.estado_reg',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},

		{
			config:{
				name: 'fecha_reg',
				fieldLabel: 'Fecha creación',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'fp.fecha_reg',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usr_reg',
				fieldLabel: 'Creado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu1.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},

		{
			config:{
				name: 'usuario_ai',
				fieldLabel: 'Funcionaro AI',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:300
			},
				type:'TextField',
				filters:{pfiltro:'fp.usuario_ai',type:'string'},
				id_grupo:1,
				grid:false,
				form:false
		},
        {
            config:{
                name: 'fecha_mod',
                fieldLabel: 'Fecha Modif.',
                allowBlank: true,
                anchor: '80%',
                gwidth: 100,
                format: 'd/m/Y',
                renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
            },
            type:'DateField',
            filters:{pfiltro:'fp.fecha_mod',type:'date'},
            id_grupo:1,
            grid:true,
            form:false
        },
		{
			config:{
				name: 'usr_mod',
				fieldLabel: 'Modificado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu2.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		}

	],
	tam_pag:50,	
	title:'Forma de Pago',
	ActSave:'../../sis_parametros/control/FormaPago/insertarFormaPago',
	ActDel:'../../sis_parametros/control/FormaPago/eliminarFormaPago',
	ActList:'../../sis_parametros/control/FormaPago/listarFormaPago',
	id_store:'id_forma_pago',
	fields: [
		{name:'id_forma_pago', type: 'numeric'},
        {name:'desc_forma_pago', type: 'string'},
        {name:'observaciones', type: 'string'},
        {name:'cod_inter', type: 'string'},
        {name:'estado_reg', type: 'string'},
        {name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
        {name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
        {name:'id_usuario_reg', type: 'numeric'},
        {name:'usr_reg', type: 'string'},
        {name:'usr_mod', type: 'string'},
        {name:'id_usuario_mod', type: 'numeric'},
        {name:'tipo', type: 'string'},
        {name:'orden', type: 'numeric'},
        {name:'codigo', type: 'string'}

	],
	sortInfo:{
		field: 'id_forma_pago',
		direction: 'ASC'
	},
	bdel:true,
	bsave:false
	}
)
</script>
		
		