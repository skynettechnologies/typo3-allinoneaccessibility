<?php
namespace Skynettechnologies\Allinoneaccessibility\Domain\Model;

/**
 * Class FileReference
 */
class FileReference extends \TYPO3\CMS\Extbase\Domain\Model\FileReference
{

    /**
     * Uid of a sys_file
     *
     * @var int
     */
    protected $originalFileIdentifier;

    /**
     * @param \TYPO3\CMS\Core\Resource\ResourceInterface $originalResource
     */
    public function setOriginalResource(\TYPO3\CMS\Core\Resource\ResourceInterface $originalResource): void
    {
        $this->setFileReference($originalResource);
    }

    /**
     * @param \TYPO3\CMS\Core\Resource\FileReference $originalResource
     */
    private function setFileReference(\TYPO3\CMS\Core\Resource\FileReference $originalResource)
    {
        $this->originalResource = $originalResource;
        $this->originalFileIdentifier = (int) $originalResource->getOriginalFile()->getUid();
        $this->uidLocal = (int) $originalResource->getOriginalFile()->getUid();
    }
}
