<?php
/*
 * @author Rebeca Martinez Garcia
 * @author Evelyn Bayas Meza
 * @author Daniel Hernández Arcos
 * @author Teodoro Tovar de la Hija
 */

/**
 * Category Source Class
 */
class Category
{
    /**
     * @var array $options
     */
    private $options;

    const OPTIONS = [
        1 => 'Metodologías Desarrollo y Calidad en la Ingeniería',
        2 => 'Dirección y Gestión de Proyectos de Software',
        3 => 'Plataformas de desarrollo de software',
        4 => 'Computación en el cliente web',
        5 => 'Computación en el servidor web',
        6 => 'Gestión de la Seguridad',
        7 => 'Seguridad en el Software',
        8 => 'Administradores de Servidores Web',
        9 => 'Usabilidad, Accesibilidad y Métricas para Sitios Web',
        10 => 'Virtualización y Computación en el nube',
        11 => 'Auditoría de la Seguridad',
        12 => 'Seguridad en Aplicaciones On Line'
    ];

    /**
     * @param $id
     * @return string
     */
    public function getOptionLabel($id): string
    {
        return key_exists($id, self::OPTIONS) ? self::OPTIONS[$id] : '';
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        $options = [];
        if ($this->options === null) {
            foreach (self::OPTIONS as $value => $label) {
                $options[] = [
                    'value' => $value,
                    'label' => $label
                ];
            }
            $this->options = $options;
        }
        return $this->options;
    }
}
