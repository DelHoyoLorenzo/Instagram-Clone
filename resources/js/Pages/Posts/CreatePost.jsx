import { useForm } from '@inertiajs/inertia-react'
import { router } from '@inertiajs/react';
import React from 'react'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'

function CreatePost({ auth }) {

    const { data, setData, post, progress } = useForm({
        image: null,
        caption: '',
    })

    const handleSubmit = (e) => {
        e.preventDefault();

        router.post(`http://localhost:8000/p/create/${auth.user.id}`, data, {
            forceFormData: true,
        })
    }

  return (
    <AuthenticatedLayout user={auth.user}>
        <div className="container">
            <form onSubmit={handleSubmit} encType="multipart/form-data">
                <div className="row">
                    <div className="col-8 offset-2">
                        <div className="row mb-3">
                            <div className="form-group row">
                            <div className="row">
                                <h1 className='text-white'>Add New Post</h1>
                            </div>
                            <label for="caption" className="col-md-4 col-form-label text-md-end text-white">Post Caption</label>
                            <input 
                            onChange={(e) => setData('caption', e.target.value)}
                            id="caption" 
                            type="text" 
                            className="" name="caption" value={data.caption}
                            autocomplete="caption" autofocus />

                            <div className="row">
                                <label for="image" className="col-md-4 col-form-label text-md-end text-white">Post Image</label>
                                <input onChange={e => setData('image', e.target.files[0])} type="file" name="image" className="text-white" id="image" />
                            </div>
                            <div className="row">
                                <button className="btn btn-primary">
                                Add New Post 
                                </button>
                            </div>
                            </div>
                                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
  )
}

export default CreatePost