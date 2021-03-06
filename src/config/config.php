<?php
/**
 * Laravel 4 Smart Errors
 *
 * @author    Andreas Lutro <anlutro@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 * @package   Laravel 4 Smart Errors
 */

return array(
	// The email the error reports will be sent to.
	'dev-email' => '',

	// send an email even if mail.pretend == true
	'force-email' => false,

	// The error handler email view.
	'error-email-view' => 'smarterror::error-email',
	'error-email-view-plain' => 'smarterror::error-email-plain',

	// The alert log handler email view.
	'alert-email-view' => 'smarterror::alert-email',
	'alert-email-view-plain' => 'smarterror::alert-email-plain',

	// The view for generic errors (uncaught exceptions). Set to null and the
	// error handler will not return a view, letting you use your own App::error
	// handler to return the appropriate view with the appropriate data.
	'error-view' => 'smarterror::generic',

	// The view for 404 errors. Set to null for same reason as above
	'missing-view' => 'smarterror::missing',

	// The view for CSRF errors. Set to null for same reason as above
	'csrf-view' => 'smarterror::csrf',

	// The PHP date() format that should be used.
	'date-format' => 'Y-m-d H:i:s e',

	// Whether to display more detailed information in stack traces.
	'expand-stack-trace' => false,

	// Whether to include query logs in error report emails.
	'include-query-log' => false,

	// Path to JSON file where metadata is stored.
	'storage-path' => storage_path('app/l4-smart-errors.json'),

	// The error handler has a throttle in place to prevent the same exception
	// from being emailed over and over. This is the number of seconds that must
	// have passed since the last exception of the same type for the new
	// exception to be emailed. Set to -1 to disable all throttling.
	'throttle-age' => 600,
);
