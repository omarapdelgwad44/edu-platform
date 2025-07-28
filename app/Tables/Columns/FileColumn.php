<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\Column;

class FileColumn extends Column
{
    protected string $view = 'tables.columns.file-column';

    protected ?string $disk = 'public';
    protected ?string $directory = null;

    public function disk(string $disk): static
    {
        $this->disk = $disk;
        return $this;
    }
    public function getViewData(): array
    {
        return array_merge(parent::getViewData(), [
            'disk' => $this->getDisk(),
            'directory' => $this->getDirectory(),
        ]);
    }

    public function directory(string $directory): static
    {
        $this->directory = $directory;
        return $this;
    }

    public function getDisk(): ?string
    {
        return $this->disk;
    }

    public function getDirectory(): ?string
    {
        return $this->directory;
    }
}
