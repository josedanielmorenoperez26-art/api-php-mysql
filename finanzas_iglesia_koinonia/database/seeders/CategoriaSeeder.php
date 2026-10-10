<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        // --- INGRESOS ---
        Categoria::create([
            'nombre' => 'Diezmos',
            'tipo' => 'ingreso',
            'descripcion' => 'Aporte del 10% de los miembros'
        ]);

        Categoria::create([
            'nombre' => 'Ofrendas Generales',
            'tipo' => 'ingreso',
            'descripcion' => 'Ofrendas recolectadas en cultos dominicales'
        ]);

        Categoria::create([
            'nombre' => 'Otros Ingresos',
            'tipo' => 'ingreso',
            'descripcion' => 'Donaciones, eventos o actividades especiales'
        ]);

        // --- GASTOS ---
        Categoria::create([
            'nombre' => 'Servicios Básicos',
            'tipo' => 'gasto',
            'descripcion' => 'Pago de luz, agua, internet'
        ]);

        Categoria::create([
            'nombre' => 'Mantenimiento y Reparaciones',
            'tipo' => 'gasto',
            'descripcion' => 'Arreglos de infraestructura, pintura, reparaciones'
        ]);

        Categoria::create([
            'nombre' => 'Materiales y Suministros',
            'tipo' => 'gasto',
            'descripcion' => 'Artículos de limpieza, oficina, útiles'
        ]);

        Categoria::create([
            'nombre' => 'Apoyo y Ayuda Social',
            'tipo' => 'gasto',
            'descripcion' => 'Ayuda a miembros o personas de la comunidad'
        ]);

        Categoria::create([
            'nombre' => 'Otros Gastos',
            'tipo' => 'gasto',
            'descripcion' => 'Gastos varios no clasificados'
        ]);
    }
}