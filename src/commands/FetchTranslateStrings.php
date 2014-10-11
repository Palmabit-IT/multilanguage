<?php namespace Palmabit\Multilanguage\Classes\Commands;

use Palmabit\Multilanguage\Classes\Commands\Translation\IlluminateFormatter;
use Palmabit\Multilanguage\Classes\Commands\Translation\LanguageHydrator;
use Palmabit\Multilanguage\Classes\Commands\Translation\Manager;
use Palmabit\Multilanguage\Classes\Commands\Translation\Saver;
use Palmabit\Multilanguage\Classes\Commands\Translation\ViewParser;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class FetchTranslateStrings extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'multilanguage:fetch_translate_strings';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'This command fetches all the string to translate and update the translation files corresponding.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
    $manager = new Manager(new ViewParser(), new LanguageHydrator(), new Saver(new IlluminateFormatter()));
    $manager->open(app_path(''))->setOutputDirectory('translation_files/')->save();
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
//	protected function getArguments()
//	{}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
//	protected function getOptions()
//	{}

}
