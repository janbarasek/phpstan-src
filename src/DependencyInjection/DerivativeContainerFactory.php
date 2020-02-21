<?php declare(strict_types = 1);

namespace PHPStan\DependencyInjection;

class DerivativeContainerFactory
{

	/** @var string */
	private $currentWorkingDirectory;

	/** @var string */
	private $tempDirectory;

	/** @var string[] */
	private $additionalConfigFiles;

	/** @var string[] */
	private $analysedPaths;

	/** @var string[] */
	private $composerAutoloaderProjectPaths;

	/** @var string[] */
	private $analysedPathsFromConfig;

	/** @var string[] */
	private $allConfigFiles;

	/**
	 * @param string $currentWorkingDirectory
	 * @param string $tempDirectory
	 * @param string[] $additionalConfigFiles
	 * @param string[] $analysedPaths
	 * @param string[] $composerAutoloaderProjectPaths
	 * @param string[] $analysedPathsFromConfig
	 * @param string[] $allConfigFiles
	 */
	public function __construct(
		string $currentWorkingDirectory,
		string $tempDirectory,
		array $additionalConfigFiles,
		array $analysedPaths,
		array $composerAutoloaderProjectPaths,
		array $analysedPathsFromConfig,
		array $allConfigFiles
	)
	{
		$this->currentWorkingDirectory = $currentWorkingDirectory;
		$this->tempDirectory = $tempDirectory;
		$this->additionalConfigFiles = $additionalConfigFiles;
		$this->analysedPaths = $analysedPaths;
		$this->composerAutoloaderProjectPaths = $composerAutoloaderProjectPaths;
		$this->analysedPathsFromConfig = $analysedPathsFromConfig;
		$this->allConfigFiles = $allConfigFiles;
	}

	/**
	 * @param string[] $additionalConfigFiles
	 * @return \PHPStan\DependencyInjection\Container
	 */
	public function create(array $additionalConfigFiles): Container
	{
		$containerFactory = new ContainerFactory(
			$this->currentWorkingDirectory
		);

		return $containerFactory->create(
			$this->tempDirectory,
			array_merge($this->additionalConfigFiles, $additionalConfigFiles),
			$this->analysedPaths,
			$this->composerAutoloaderProjectPaths,
			$this->analysedPathsFromConfig,
			$this->allConfigFiles
		);
	}

}
