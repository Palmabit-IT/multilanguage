<?php namespace Palmabit\Multilanguage\Classes;
/**
 * Class MultilinguaRepositoryBase
 *
 * @author jacopo beschi j.beschi@palmabit.com
 */
use Palmabit\Multilanguage\Traits\LanguageHelper;
use Palmabit\Multilanguage\Interfaces\MultilinguaRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class MultilinguaRepositoryBase implements MultilinguaRepositoryInterface{
    use LanguageHelper;
    /**
     * If the repo will be used for admin area or not
     * @var Boolean
     */
    protected $is_admin;
    /**
     * The name of the model to use
     * @var String
     */
    protected $model;

    public function __construct($is_admin = true)
    {
        $this->is_admin = $is_admin;
    }

    /**
     * Gets all the objects
     *
     * @return mixed
     */
    public function all()
    {
        $model = $this->model;
        return $model::whereLang($this->getLingua())->get()->all();
    }

    /**
     * Finds a model
     *
     * @param $id
     * @return mixed
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($id)
    {
        $model = $this->model;
        return $model::findOrFail($id);
    }

    /**
     * Updates a model
     *
     * @param       $id
     * @param array $data
     * @return mixed
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update($id, array $data)
    {
        // clear slug_lingua
        if(isset($data["slug_lingua"])) unset($data["slug_lingua"]);
        $obj = $this->find($id);
        $obj->update($data);

        return $obj;
    }

    /**
     * Creates a model
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $model = $this->model;
        $data["slug_lingua"] = $data["slug_lingua"] ? $data["slug_lingua"] : $this->generaSlugLingua($data);
        $data["lang"] = $this->getLingua();

        return $model::create($data);
    }

    /**
     * Deletes data
     *
     * @param $id
     * @return mixed
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id)
    {
        $obj = $this->find($id);
        return $obj->delete();
    }


    /**
     * Obtain the resource given the slug lingua
     *
     * @param $slug_lingua
     * @return mixed
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findBySlugLingua($slug_lingua)
    {
        $model = $this->model;
        $obj = $model::whereSlugLingua($slug_lingua)
            ->whereLang($this->getLingua())
            ->get();

        if($obj->isEmpty()) throw new ModelNotFoundException;

        return $obj->first();
    }

} 