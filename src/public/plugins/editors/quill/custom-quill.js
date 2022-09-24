// Basic
if ($("#editor-container").length != 0) {
    var quill = new Quill('#editor-container', {
        modules: {
            toolbar: [[{align: ''}, {align: 'center'}, {align: 'right'}, {align: 'justify'}], [{header: [1, 2, 3, 4, 5, 6, false]}], ['bold', 'italic', 'underline'], [{'direction': 'ltr'}], [{'color': ["#000000", "#e60000", "#ff9900", "#ffff00", "#008a00", "#0066cc", "#9933ff", "#ffffff", "#facccc", "#ffebcc", "#ffffcc", "#cce8cc", "#cce0f5", "#ebd6ff", "#bbbbbb", "#f06666", "#ffc266", "#ffff66", "#66b966", "#66a3e0", "#c285ff", "#888888", "#a10000", "#b26b00", "#b2b200", "#006100", "#0047b2", "#6b24b2", "#444444", "#5c0000", "#663d00", "#666600", "#003700", "#002966", "#3d1466", 'custom-color']}]]
        }, placeholder: 'اضافة قطعه...', theme: 'snow'  // or 'bubble'
    });
}

if ($(".quill-sentence").length != 0) {
    let containers = document.querySelectorAll('.quill-sentence');
    Array.from(containers).map(function (container) {
        return new Quill(container, {
            modules: {
                toolbar: [[{align: ''}, {align: 'center'}, {align: 'right'}, {align: 'justify'}], [{header: [1, 2, 3, 4, 5, 6, false]}], ['bold', 'italic', 'underline'], [{'direction': 'ltr'}], [{'color': ["#000000", "#e60000", "#ff9900", "#ffff00", "#008a00", "#0066cc", "#9933ff", "#ffffff", "#facccc", "#ffebcc", "#ffffcc", "#cce8cc", "#cce0f5", "#ebd6ff", "#bbbbbb", "#f06666", "#ffc266", "#ffff66", "#66b966", "#66a3e0", "#c285ff", "#888888", "#a10000", "#b26b00", "#b2b200", "#006100", "#0047b2", "#6b24b2", "#444444", "#5c0000", "#663d00", "#666600", "#003700", "#002966", "#3d1466", 'custom-color']}]]
            }, placeholder: 'اضافة قطعه...', theme: 'snow'  // or 'bubble'
        });
    });
}


// With Tooltip
//
// var quill = new Quill('#quill-tooltip', {
//     modules: {
//         toolbar: '#toolbar-container'
//     }, placeholder: 'Compose an epic...', theme: 'snow'
// });

// Enable all tooltips
$('[data-toggle="tooltip"]').tooltip();

// Can control programmatically too
// $('.ql-italic').mouseover();
// setTimeout(function () {
//     $('.ql-italic').mouseout();
// }, 2500);