<?php

namespace KodeHauz\Solfa;

/**
 * Represents a single beat and the notes that are contained.
 *
 */
class Beat {
    
  /**
   * The solfa notes that make up this beat.
   *
   * @var \KodeHauz\Solfa\Note[]
   */
  protected $notes;

  /**
   * Creates a new beat made of the specified notes.
   *
   * @param \KodeHauz\Solfa\Note[] $notes
   */
  public function __construct(array $notes = array()) {
    $this->notes = $notes;
  }

  public function addNote(Note $note) {
    $this->notes[] = $note;
  }

  public function getNote($index) {
    return $this->notes[$index];
  }

  /**
   * @return Note[]
   */
  public function getNotes() {
    return $this->notes;
  }

}
