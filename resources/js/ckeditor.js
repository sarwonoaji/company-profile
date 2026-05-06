// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

// document.addEventListener('DOMContentLoaded', () => {
//     const el = document.querySelector('#editor');
//     if (el) {
//         ClassicEditor.create(el, {
//             toolbar: {
//                 items: [
//                     'heading',
//                     '|',
//                     'bold',
//                     'italic',
//                     'link',
//                     'bulletedList',
//                     'numberedList',
//                     'blockQuote',
//                     '|',
//                     'insertTable',
//                     'imageUpload',
//                     '|',
//                     'undo',
//                     'redo'
//                 ]
//             },
//             image: {
//                 toolbar: [ 'imageTextAlternative', 'imageStyle:full', 'imageStyle:side' ]
//             }
//         }).catch(error => { console.error(error); });
//     }
// });

// // Helper: runtime upload adapter converting files to base64 (no backend required)
// function Base64UploadAdapter(loader) {
//     this.loader = loader;
// }

// Base64UploadAdapter.prototype.upload = function() {
//     return this.loader.file.then(file => new Promise((resolve, reject) => {
//         const reader = new FileReader();
//         reader.onload = () => resolve({ default: reader.result });
//         reader.onerror = err => reject(err);
//         reader.readAsDataURL(file);
//     }));
// };

// Base64UploadAdapter.prototype.abort = function() {
//     // optional: implement abort behavior
// };

// // Expose editor instance and attach upload adapter when created
// document.addEventListener('DOMContentLoaded', () => {
//     const el = document.querySelector('#editor');
//     if (!el) return;
//     ClassicEditor.create(el).then(editor => {
//         // Attach base64 upload adapter to the FileRepository
//         const fileRepo = editor.plugins.get('FileRepository');
//         fileRepo.createUploadAdapter = (loader) => new Base64UploadAdapter(loader);
//         window.CKEditorInstance = editor; // for debugging in console
//         console.log('CKEditor initialized (with Base64 upload adapter).', editor);
//     }).catch(error => console.error(error));
// });


import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

document.addEventListener('DOMContentLoaded', () => {
    const editorElement = document.querySelector('#editor');
    if (!editorElement) return;

    ClassicEditor.create(editorElement, {
        toolbar: {
            items: [
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                '|',
                'alignment', // ✅ INI KUNCINYA
                '|',
                'bulletedList',
                'numberedList',
                'blockQuote',
                '|',
                'insertTable',
                'imageUpload',
                '|',
                'undo',
                'redo'
            ]
        },
        alignment: {
            options: [ 'left', 'center', 'right', 'justify' ]
        },
        image: {
            toolbar: [
                'imageTextAlternative',
                'imageStyle:full',
                'imageStyle:side'
            ]
        }
    })
    .then(editor => {
        editor.plugins.get('FileRepository').createUploadAdapter = loader => {
            return new Base64UploadAdapter(loader);
        };

        window.CKEditorInstance = editor;
        console.log('CKEditor OK + alignment dropdown aktif');
    })
    .catch(error => console.error(error));
});

class Base64UploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        return this.loader.file.then(file => new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = () => resolve({ default: reader.result });
            reader.onerror = err => reject(err);
            reader.readAsDataURL(file);
        }));
    }

    abort() {}
}
