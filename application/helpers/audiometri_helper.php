<?php
// File: application/helpers/audiometri_helper.php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Audiometri Helper Functions
 * 
 * @author ArChiee
 */

if (!function_exists('get_hearing_level_class')) {
    /**
     * Get CSS class for hearing level
     */
    function get_hearing_level_class($db_value) {
        if ($db_value <= 25) return 'success';
        else if ($db_value <= 40) return 'warning';
        else if ($db_value <= 55) return 'orange';
        else if ($db_value <= 70) return 'danger';
        else if ($db_value <= 90) return 'dark';
        else return 'dark';
    }
}

if (!function_exists('classify_hearing_loss')) {
    /**
     * Classify hearing loss level
     */
    function classify_hearing_loss($db_value) {
        if ($db_value <= 25) return 'Normal';
        else if ($db_value <= 40) return 'Mild hearing loss';
        else if ($db_value <= 55) return 'Moderate hearing loss';
        else if ($db_value <= 70) return 'Moderately severe hearing loss';
        else if ($db_value <= 90) return 'Severe hearing loss';
        else return 'Profound hearing loss';
    }
}

if (!function_exists('format_audiometric_value')) {
    /**
     * Format audiometric value for display
     */
    function format_audiometric_value($value) {
        if (is_null($value) || $value === '') {
            return '-';
        }
        return number_format($value, 1) . ' dB';
    }
}

if (!function_exists('get_frequencies_array')) {
    /**
     * Get standard audiometric frequencies
     */
    function get_frequencies_array() {
        return ['250', '500', '1000', '2000', '3000', '4000', '6000'];
    }
}

if (!function_exists('generate_audiogram_summary')) {
    /**
     * Generate summary of audiogram results
     */
    function generate_audiogram_summary($test_data) {
        $frequencies = get_frequencies_array();
        $summary = [];
        
        // Analyze each ear and conduction type
        $ears = ['right', 'left'];
        $types = ['ac', 'bc'];
        
        foreach ($ears as $ear) {
            foreach ($types as $type) {
                $values = [];
                foreach ($frequencies as $freq) {
                    $key = "{$ear}_{$type}_{$freq}";
                    if (isset($test_data[$key]) && is_numeric($test_data[$key])) {
                        $values[] = (float)$test_data[$key];
                    }
                }
                
                if (!empty($values)) {
                    $avg = array_sum($values) / count($values);
                    $ear_label = ucfirst($ear);
                    $type_label = strtoupper($type);
                    
                    $summary[] = [
                        'ear' => $ear_label,
                        'type' => $type_label,
                        'average' => $avg,
                        'classification' => classify_hearing_loss($avg),
                        'values_count' => count($values)
                    ];
                }
            }
        }
        
        return $summary;
    }
}

if (!function_exists('validate_audiometric_data')) {
    /**
     * Validate audiometric input data
     */
    function validate_audiometric_data($data) {
        $errors = [];
        $frequencies = get_frequencies_array();
        $ears = ['right', 'left'];
        $types = ['ac', 'bc'];
        
        foreach ($ears as $ear) {
            foreach ($types as $type) {
                foreach ($frequencies as $freq) {
                    $key = "{$ear}_{$type}_{$freq}";
                    if (isset($data[$key]) && $data[$key] !== '') {
                        $value = (float)$data[$key];
                        if ($value < -10 || $value > 140) {
                            $errors[] = "Nilai {$ear} {$type} {$freq}Hz harus antara -10 hingga 140 dB";
                        }
                    }
                }
            }
        }
        
        return $errors;
    }
}

if (!function_exists('export_audiometric_csv')) {
    /**
     * Export audiometric data to CSV format
     */
    function export_audiometric_csv($data, $filename = null) {
        if (!$filename) {
            $filename = 'audiometri_export_' . date('Y-m-d_H-i-s') . '.csv';
        }
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // CSV Headers
        $headers = [
            'No', 'Tanggal Tes', 'No RM', 'Nama', 'Umur', 'Jenis Kelamin',
            'Perusahaan', 'Jabatan', 'Impression'
        ];
        
        // Add frequency headers
        $frequencies = get_frequencies_array();
        $ears = ['Right', 'Left'];
        $types = ['AC', 'BC'];
        
        foreach ($ears as $ear) {
            foreach ($types as $type) {
                foreach ($frequencies as $freq) {
                    $headers[] = "{$ear}-{$type}-{$freq}Hz";
                }
            }
        }
        
        fputcsv($output, $headers);
        
        // Data rows
        $no = 1;
        foreach ($data as $row) {
            $csv_row = [
                $no++,
                date('d/m/Y', strtotime($row['tanggal_tes'])),
                $row['no_rm'],
                $row['nama'],
                $row['umur'],
                $row['jenis_kelamin'],
                $row['perusahaan'],
                $row['jabatan'],
                $row['impression']
            ];
            
            // Add frequency data
            foreach ($ears as $ear) {
                foreach ($types as $type) {
                    foreach ($frequencies as $freq) {
                        $key = strtolower($ear) . '_' . strtolower($type) . '_' . $freq;
                        $csv_row[] = $row[$key] ?? '';
                    }
                }
            }
            
            fputcsv($output, $csv_row);
        }
        
        fclose($output);
        exit;
    }
}
?>
