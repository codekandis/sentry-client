<?php declare( strict_types = 1 );
namespace CodeKandis\SentryClient\Outputs;

use CodeKandis\ConstantsClassesTranslator\ConstantsClassesTranslator;
use CodeKandis\SentryClient\ErrorLevelNames;
use CodeKandis\SentryClient\ErrorLevelValues;
use function printf;

/**
 * Represents an error output.
 * @package codekandis/sentry-client
 * @author Christian Ramelow <info@codekandis.net>
 */
class ErrorOutput implements ErrorOutputInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function print( string $severity, int $level, string $message, string $file, int $line ): void
	{
		$levelName = ( new ConstantsClassesTranslator( ErrorLevelValues::class, ErrorLevelNames::class ) )
			->translate( $level );

		$paddingLength = 11;
		printf(
			"execution interrupted\n%-{$paddingLength}s%s\n%-{$paddingLength}s%s\n%-{$paddingLength}s%s\n%-{$paddingLength}s%s\n%-{$paddingLength}s%s\n%-{$paddingLength}s%s\n",
			'[type]',
			'error',
			'[severity]',
			$severity,
			'[level]',
			$levelName,
			'[message]',
			$message,
			'[line]',
			$line,
			'[file]',
			$file
		);
	}
}
