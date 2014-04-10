<?php
/**
 * Base class for all Documents to extend
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Document;

use Doctrine\Common\Persistence\PersistentObject;

abstract class AbstractDocument extends PersistentObject
{
    /**
     * Universal method used to hydrate a document from an array of data
     * @param array $data - key-value array of data to be hydrated into a Document
     */
    public function fromArray(array $data)
    {
        foreach ($data as $key => $value) {
            if (method_exists($this, 'set' . ucfirst($key))) {
                /**
                 * There's a custom setter for this attribute
                 */
                $this->{'set' . ucfirst($key)}($value);
            } else {
                $this->$key = $value;
            }
        }
    }
}
