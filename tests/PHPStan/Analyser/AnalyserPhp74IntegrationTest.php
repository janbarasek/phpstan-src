<?php declare(strict_types = 1);

namespace PHPStan\Analyser;

class AnalyserPhp74IntegrationTest extends \PHPStan\Testing\TestCase
{

	public function testErrors(): void
	{
		$errors = $this->runAnalyse(__DIR__ . '/data/removedOnPhp80.php');
		$this->assertCount(0, $errors);
	}

	/**
	 * @return string[]
	 */
	public static function getAdditionalConfigFiles(): array
	{
		return [
			__DIR__ . '/php74.neon',
		];
	}


	/**
	 * @param string $file
	 * @return \PHPStan\Analyser\Error[]
	 */
	private function runAnalyse(string $file): array
	{
		$file = $this->getFileHelper()->normalizePath($file);
		/** @var \PHPStan\Analyser\Analyser $analyser */
		$analyser = self::getContainer()->getByType(Analyser::class);

		return $analyser->analyse([$file])->getErrors();
	}

}