<?php
/**
 * All methods used for obtaining data from monitoring.krakow.pios.gov.pl
 *
 * @author: Krzysztof Wójcicki <krzysztof.wojcicki@gmail.com>
 */

namespace Dashboard\Model\Dao;

class SmogDao extends AbstractDao
{
    public function fetchForSmogWidget(array $params = [])
    {
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_HTML);
        $table = (array) $response->xpath('//body/center')[0]->xpath('./table')[0]->xpath('.//tr');
        $norms = $this->config['norms'];

        $result = [];
        foreach ($table as $i => $row) {
            if ($i < 2) {
                continue;
            }

            $cells = $row->xpath('td');
            $name = trim(strip_tags((string) $cells[0]->asXml()));
            $unit = trim(strip_tags((string) $cells[1]->asXml()));
            $norm = trim(strip_tags((string) $cells[2]->asXml()));
            $parameter = preg_replace('/.*\((.*)\)/', '\1', $name);
            $value = null;

            if (empty($norm)) {
                $norm = @$norms[strtoupper($parameter)];
            }

            if (empty($norm)) {
                continue;
            }

            for ($i = count($cells) - 1; $i > 2; --$i) {
                $candidateValue = trim(strip_tags((string) $cells[$i]->asXml()));
                if (!empty($candidateValue)) {
                    $value = $candidateValue;
                    break;
                }
            }

            $result[] = [
                'name' => $name,
                'norm' => (double) $norm,
                'unit' => $unit,
                'value' => (double) $value,
                'percent' => 100 * ((double) $value) / ((double) $norm),
                'parameter' => $parameter,
            ];
        }

        return $result;
    }
}
