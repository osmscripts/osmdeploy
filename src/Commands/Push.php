<?php

namespace OsmScripts\OsmDeploy\Commands;

use OsmScripts\Core\Command;
use OsmScripts\Core\Project;
use OsmScripts\Core\Script;

/** @noinspection PhpUnused */

/**
 * `push` shell command class.
 *
 * @property Project $project Information about Composer project in current
 *      working directory
 * @property string[] $directories Project directories having their own Git
 *      repos. Used in Manadev for Magento development
 */
class Push extends Command
{
    #region Properties
    public function default($property) {
        /* @var Script $script */
        global $script;

        switch ($property) {
            case 'project': return new Project(['path' => $script->cwd]);
            case 'directories': return $this->getDirectories();
        }

        return parent::default($property);
    }

    protected function getDirectories() {
    }

    #endregion

    protected function configure() {
        // TODO: describe the command usage, arguments and options
    }

    protected function handle() {
        $this->verifyNoUncommittedChanges();
        $this->pushPackages();
        $this->pushDirectories();
        $this->pushProject();
        $this->waitForPackagist();
        $this->updateTargets();
    }

    protected function verifyNoUncommittedChanges() {
        // verify package repos
        $this->project->verifyNoUncommittedChanges();

        // verify directories with Git repos (pre-Composer era)
        foreach ($this->directories as $directory) {
            $this->project->verifyNoUncommittedChangesInDirectory($directory);
        }

        // verify project repo
        $this->project->verifyNoUncommittedChangesInDirectory('');

    }

    protected function pushPackages() {
    }

    protected function pushDirectories() {
    }

    protected function pushProject() {
    }

    protected function waitForPackagist() {
    }

    protected function updateTargets() {
    }
}