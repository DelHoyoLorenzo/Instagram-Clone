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
        <div class="container">
            <form onSubmit={handleSubmit} encType="multipart/form-data">
                <div class="row">
                    <div class="col-8 offset-2">
                        <div class="row mb-3">
                            <div class="form-group row">
                            <div class="row">
                                <h1>Add New Post</h1>
                            </div>
                            <label for="caption" class="col-md-4 col-form-label text-md-end">Post Caption</label>
                            <input 
                            onChange={(e) => setData('caption', e.target.value)}
                            id="caption" 
                            type="text" 
                            class="" name="caption" value={data.caption}
                            autocomplete="caption" autofocus />

                            <div class="row">
                                <label for="image" class="col-md-4 col-form-label text-md-end">Post Image</label>
                                <input onChange={e => setData('image', e.target.files[0])} type="file" name="image" class="" id="image" />
                            </div>
                            <div class="row">
                                <button class="btn btn-primary">
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