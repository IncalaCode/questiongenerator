


function extract() {
    //
    var file = handleFile()

}


function displaydocx(file) {
    var result1 = "unknown";
    return new Promise((resolve, reject) => {
        var reader = new FileReader();
        reader.onloadend = function (event) {
            var arrayBuffer = reader.result;
            mammoth.convertToHtml({ arrayBuffer: arrayBuffer }).then(function (resultObject) {
                result1 = resultObject.value;
                console.log(result1);
                const myTextElement = document.getElementById('myText');
                console.log(myTextElement);
                myTextElement.addEventListener('mouseup', function () {
                    const selectedText = window.getSelection().toString();
                    if (selectedText) {
                        const highlightedText = `<span class="highlighted">${selectedText}</span>`;
                        myTextElement.innerHTML = myTextElement.innerHTML.toString().replace(selectedText, highlightedText);
                    }
                });
                myTextElement.innerHTML = result1;
                resolve(result1);
            }).catch(error => {
                reject(error);
            });
        };
        reader.onerror = function (error) {
            reject(error);
        };
        reader.readAsArrayBuffer(file);
    });
}


function handleFile(file) {

    if (file) {
        const name = console.log('File name:', file.name);
        const size = console.log('File size:', file.size); /// remove it 
        console.log('File type:', file.type);
        if (file.type == "application/pdf") {
            pdf(file);
        }
        else if (file.type == "application/vnd.ms-powerpoint") {
            ppt(file);
        } else if (file.type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
            doc(file)
        }
        else {
            errorlog("not supported");
        }

    }
}

function doc(file) {
    displaydocx(file)
}
function removeHTMLTags(text) {
    return text.replace(/<[^>]*>/g, "Discuss");
}
function ppt(file) {
    link(file).then((value) => {
        if (check(value)) {
            doc(value);
        }
    })

}
function pdf(file) {
    link(file).then((value) => {
        if (check(value)) {
            doc(value);
        }
    });

}

function check(value) {
    if (value != "false") {
        return true;
    }
    return true;
}
function link(file) {
    return new Promise((resolve, reject) => {
        var data = new FormData()
        data.append('file', file)
        console.log(data);
        fetch('aiscript\\php\\test.php', {
            method: 'POST',
            headers: {
                'containt': "application/json utf-8"
            },
            body: data

        }).then(res => {
            return res.text(); // Handle the response data
        }).then(data => {

            console.log(data);
            if (data != "false") {
                fetch(data)
                    .then(response => response.blob())
                    .then(arrayBuffer => {
                        const data = new File([arrayBuffer], 'file.docx', { type: 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' });
                        displaydocx(data);
                    })

            } else {
                errorlog("");
            }



        })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
        alert("uploded successfully");
    });
}
function errorlog(error) {

}

function parseWordDocxFile(inputElement) {
    var files = inputElement.files || [];
    handleFile(inputElement.files[0])
}

