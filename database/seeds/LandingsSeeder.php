<?php

use Illuminate\Database\Seeder;

class LandingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

	    $servicio = [
	    	'nombre' => 'Landing Insert',
		    'slug' => 'landing_insert',
		    'datos' => 'insertRegistroDc.php?cliente=DERCONTADOR&token=5393aa431688ad3b008ee4b27f535325',
		    'estado' => 1,
		    'crm_id' => 1,
		    'campos' => [
		    	[
		    		'nombre'    => 'Nombre',
				    'requerido' => true,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Cedula',
				    'requerido' => false,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Celular',
				    'requerido' => true,
				    'tipo'      => 'numeric',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Email',
				    'requerido' => true,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Nombre_de_formulario',
				    'requerido' => true,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Descripcion_carro',
				    'requerido' => false,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Precio_lista',
				    'requerido' => false,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Descuento',
				    'requerido' => false,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Precio_Dercontador',
				    'requerido' => false,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Marca',
				    'requerido' => false,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Linea',
				    'requerido' => false,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Modelo',
				    'requerido' => false,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Fecha_de_separacion',
				    'requerido' => false,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Direccion',
				    'requerido' => false,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Ciudad',
				    'requerido' => true,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Concesionario',
				    'requerido' => false,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Acepto_terminos_condiciones',
				    'requerido' => true,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'Acepto_que_mi_informacion',
				    'requerido' => true,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'registroId',
				    'requerido' => true,
				    'tipo'      => 'string',
				    'estado'    => 1
			    ],
			    [
				    'nombre'    => 'timestamp',
				    'requerido' => true,
				    'tipo'      => 'time_unix',
				    'estado'    => 1
			    ],
                [
                    'nombre'    => 'color',
                    'requerido' => false,
                    'tipo'      => 'string',
                    'estado'    => 1
                ]
		    ]
	    ];

	    $landings = [
	        [
	        	'nombre'    => 'Log de pagos',
		        'endpoint'  => 'http://webprojects.rocks/clientes/massdigital/dercontador2017/wordpress/wp-content/plugins/exports-and-reports/api.php?report=7&full=1&action=json&token=5956cef64daa1&export_type=json',
		        'db_name'   => 'landing_log_de_pagos',
		        'landing_identificador' => 'referencia',
		        'campo_fecha' => 'fecha_creacion',
		        'activo'    => true,
		        'campos'    => [
		        	    'Nombre_de_formulario',
			            'nombre',
				        'telefono',
				        'email',
				        'direccion',
				        'cedula',
				        'ciudad',
				        'agencia',
				        'meta_value',
				        'vehiculo',
				        'estado'
		        ]
	        ],
	        [
	        	'nombre'    => 'Interesados',
		        'endpoint'  => 'http://webprojects.rocks/clientes/massdigital/dercontador2017/wordpress/wp-content/plugins/exports-and-reports/api.php?report=3&full=1&action=json&token=5956cef64daa1&export_type=json',
		        'db_name'   => 'landing_interesados',
		        'landing_identificador' => 'id',
		        'campo_fecha' => 'datetime',
		        'activo'    => true,
		        'campos'    => [
		        	    'Nombre_de_formulario',
			            'nombre',
				        'email',
				        'celular',
				        'id_vehiculo',
				        'vehiculo',
				        'color_carro',
				        'acepto_tyc',
				        'acepto_mar',
				        'meta_value'
		        ]
	        ],
	        [
	        	'nombre'    => 'PQR',
		        'endpoint'  => 'http://webprojects.rocks/clientes/massdigital/dercontador2017/wordpress/wp-content/plugins/exports-and-reports/api.php?report=8&full=1&action=json&token=5956cef64daa1&export_type=json',
		        'db_name'   => 'landing_pqr',
		        'landing_identificador' => 'id_pqr',
		        'campo_fecha' => 'fecha',
		        'activo'    => true,
		        'campos'    => [
		        	    'Nombre_de_formulario',
			            'nombre',
				        'email',
				        'nro_identificacion',
				        'ciudad',
				        'direccion',
				        'celular',
				        'marca',
				        'linea',
				        'modelo',
				        'placa',
				        'vin',
				        'kms',
				        'taller',
				        'persona_contactada',
				        'mensaje',
				        'dia',
				        'mes',
				        'ano',
				        'acepto_tyc',
				        'acepto_mar'
		        ]
	        ],
	        [
	        	'nombre'    => 'Contacto',
		        'endpoint'  => 'http://webprojects.rocks/clientes/massdigital/dercontador2017/wordpress/wp-content/plugins/exports-and-reports/api.php?report=9&full=1&action=json&token=5956cef64daa1&export_type=json',
		        'db_name'   => 'landing_contacto',
		        'landing_identificador' => 'id_contact',
		        'campo_fecha' => 'fecha',
		        'activo'    => true,
		        'campos'    => [
			        'Nombre_de_formulario',
			        'nombre',
			        'email',
			        'nro_identificacion',
			        'ciudad',
			        'direccion',
			        'celular',
			        'asunto',
			        'mensaje',
			        'acepto_tyc',
			        'acepto_mar',
		        ]
	        ]
	    ];

	    $nuevoServicio = \App\Models\Admin\ServicioCrm::where('slug', 'landing_insert')->first();

	    if(!isset($nuevoServicio)) {
		    $nuevoServicio = \App\Models\Admin\ServicioCrm::create( array_except( $servicio, 'campos' ) );

		    foreach ( $servicio['campos'] as $campo ) {
			    $nuevoServicio->camposServiciosCrms()
			                  ->save( new \App\Models\Admin\CampoServicioCrm( $campo ) );
		    }
	    }

	    foreach ( $landings as $landingData ) {

		    \Illuminate\Support\Facades\DB::transaction(function() use ($landingData, $nuevoServicio) {

		        $campos = $landingData['campos'];
	            $landing = \App\Models\Admin\Landing::create(array_except($landingData, 'campos'));

			    // Crear tabla para el landing
			    \Illuminate\Support\Facades\Schema::create($landing->db_name, function (\Illuminate\Database\Schema\Blueprint $table) use ($campos) {
				    $table->string('id');
				    $table->string('landing_identificador');
				    $table->string('fecha_creacion');
				    $table->boolean('habeas')->default(true);
				    $table->boolean('terminos')->default(true);

				    foreach ($campos as $campo) {
					    $table->string(\App\Providers\FuncionesProvider::limpiaCadena($campo));
				    }

				    $table->timestamps();
			    });

			    // asociar el landing al servicio del crm
			    \App\Models\Admin\ServiciosCrmsXLanding::create(['landing_id' => $landing->id, 'servicios_crm_id' => $nuevoServicio->id, 'estado' => true]);
		    });
	    }


    }
}
