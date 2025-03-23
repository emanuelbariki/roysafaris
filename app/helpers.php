<?

use Illuminate\Database\Eloquent\Model;


/**
 * Check if data exists in the database.
 *
 * @param string|Model $model The Eloquent model class.
 * @param array $conditions An associative array of conditions (e.g., ['column' => 'value']).
 * @return bool True if data exists, false otherwise.
 */
if (!function_exists('exists')) {
    # code...
    function exists(string|Model $model, array $conditions): bool
    {
        return $model::where($conditions)->exists();

    }
}











?>