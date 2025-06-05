document.addEventListener('DOMContentLoaded', function() {
    function initializePostManagement() {
        let postFileInput = document.getElementById('lampiran');
        let postFileNameDisplay = document.getElementById('FileNamaFoto');
        let postPreviewContainer = document.getElementById('previewContainer');
        let postPreviewImage = document.getElementById('previewImage');
        let postPreviewText = document.getElementById('previewText');
        let browseBtn = document.getElementById('browseButton');
        let deleteBtn = document.getElementById('deleteButton');

        console.log('Initializing post management with separate buttons');
        console.log('browseBtn:', browseBtn);
        console.log('deleteBtn:', deleteBtn);
        console.log('postFileInput:', postFileInput);

        if (!browseBtn || !deleteBtn || !postFileInput) {
            console.error('Required elements not found. Setting up MutationObserver...');
            const observer = new MutationObserver((mutations, obs) => {
                postFileInput = document.getElementById('lampiran');
                postFileNameDisplay = document.getElementById('FileNamaFoto');
                postPreviewContainer = document.getElementById('previewContainer');
                postPreviewImage = document.getElementById('previewImage');
                postPreviewText = document.getElementById('previewText');
                browseBtn = document.getElementById('browseButton');
                deleteBtn = document.getElementById('deleteButton');

                if (browseBtn && deleteBtn && postFileInput) {
                    console.log('Elements found via observer. Setting up handlers.');
                    setupEventHandlers();
                    obs.disconnect();
                }
            });

            observer.observe(document.body, { childList: true, subtree: true });
            return;
        }

        // Initialize preview if there's an existing image
        if (postPreviewImage && postPreviewImage.src && postPreviewImage.src !== '') {
            showDeleteButton();
        } else {
            showBrowseButton();
        }

        setupEventHandlers();

        function setupEventHandlers() {
            // Event listener for Browse button
            if (browseBtn) {
                browseBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Browse button clicked');
                    postFileInput.click();
                });
            }

            // Event listener for Delete button
            if (deleteBtn) {
                deleteBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Delete button clicked');
                    
                    // Clear file input
                    postFileInput.value = '';
                    
                    // Reset preview
                    resetPostPreview();
                });
            }

            // File input change event
            if (postFileInput) {
                postFileInput.addEventListener('change', function(e) {
                    console.log('File input changed, files:', this.files.length);
                    
                    const file = this.files[0];
                    if (file) {
                        console.log('File selected:', file.name);
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            console.log('File loaded successfully');
                            
                            // Update preview
                            if (postPreviewImage) {
                                postPreviewImage.src = e.target.result;
                                postPreviewImage.style.display = 'block';
                            }
                            if (postPreviewText) {
                                postPreviewText.style.display = 'none';
                            }
                            if (postPreviewContainer) {
                                postPreviewContainer.classList.add('has-image');
                            }
                            if (postFileNameDisplay) {
                                postFileNameDisplay.textContent = 'File dipilih: ' + file.name;
                            }
                            
                            // Toggle buttons
                            showDeleteButton();
                        };
                        reader.readAsDataURL(file);
                    } else {
                        console.log('No file selected');
                        resetPostPreview();
                    }
                });
            }
        }

        function showDeleteButton() {
            console.log('Showing delete button, hiding browse button');
            if (browseBtn) {
                browseBtn.style.display = 'none';
            }
            if (deleteBtn) {
                deleteBtn.style.display = 'inline-block';
            }
        }

        function showBrowseButton() {
            console.log('Showing browse button, hiding delete button');
            if (browseBtn) {
                browseBtn.style.display = 'inline-block';
            }
            if (deleteBtn) {
                deleteBtn.style.display = 'none';
            }
        }

        function resetPostPreview() {
            console.log('Resetting preview and showing browse button');
            
            if (postPreviewImage) {
                postPreviewImage.src = '';
                postPreviewImage.style.display = 'none';
            }
            
            if (postPreviewText) {
                postPreviewText.style.display = 'block';
            }
            
            if (postPreviewContainer) {
                postPreviewContainer.classList.remove('has-image');
            }
            
            if (postFileNameDisplay) {
                postFileNameDisplay.textContent = 'Pilih file';
            }
            
            // Toggle buttons back
            showBrowseButton();
        }
    }

    // Initialize Trix editor and hide attach files button
    function initializeTrixEditor() {
        const waitForTrix = setInterval(function() {
            const trixEditor = document.querySelector("trix-editor");
            if (trixEditor) {
                const toolbar = trixEditor.toolbarElement;
                if (toolbar) {
                    const attachButton = toolbar.querySelector("[data-trix-action='attachFiles']");
                    if (attachButton) {
                        attachButton.style.display = "none";
                        clearInterval(waitForTrix);
                    }
                }
            }
        }, 100);
    }

    // Toggle tujuan field based on post type
    function initializePostTypeToggle() {
        const pengumumanRadio = document.getElementById('pengumuman');
        const blogRadio = document.getElementById('blog');
        const tujuanContainer = document.getElementById('tujuanContainer');

        if (pengumumanRadio && blogRadio && tujuanContainer) {
            function toggleTujuanField() {
                if (pengumumanRadio.checked) {
                    tujuanContainer.style.display = 'block';
                } else {
                    tujuanContainer.style.display = 'none';
                }
            }

            pengumumanRadio.addEventListener('change', toggleTujuanField);
            blogRadio.addEventListener('change', toggleTujuanField);
            toggleTujuanField(); // Initial check
        }
    }

    // Other existing functionality (unchanged)
    const filterSelect = document.getElementById('TipePost');
    const filterForm = document.getElementById('filterForm');
    const tambahPost = document.getElementById('tambahPost');
    const pengumumanList = document.getElementById('pengumumanList');
    const blogList = document.getElementById('blogList');
    const postForm = document.getElementById('postForm');
    const successAlert = document.getElementById('successAlert');
    const errorMessage = document.getElementById('errorMessage');

    if (filterSelect && filterForm) {
        filterSelect.addEventListener('change', function() {
            console.log('Filter changed to:', this.value);
            const selectedValue = this.value;

            if (tambahPost) tambahPost.style.display = selectedValue === '' ? 'block' : 'none';
            if (pengumumanList) pengumumanList.style.display = selectedValue === 'pengumuman' ? 'block' : 'none';
            if (blogList) blogList.style.display = selectedValue === 'blog' ? 'block' : 'none';

            try {
                filterForm.submit();
                console.log('Form submitted');
            } catch (error) {
                console.error('Form submission error:', error);
            }
        });
    }

    function initializeDisplay() {
        const selectedValue = filterSelect ? filterSelect.value : '';
        console.log('Initializing display with value:', selectedValue);

        if (tambahPost) tambahPost.style.display = selectedValue === '' ? 'block' : 'none';
        if (pengumumanList) pengumumanList.style.display = selectedValue === 'pengumuman' ? 'block' : 'none';
        if (blogList) blogList.style.display = selectedValue === 'blog' ? 'block' : 'none';
    }

    if (filterSelect) {
        initializeDisplay();
    }

    if (postForm) {
        postForm.addEventListener('submit', function(e) {
            const judul = document.getElementById('judul').value;
            const isi = document.querySelector('trix-editor[input="isi"]')?.value || 
                       document.querySelector('trix-editor[input="isi_trix"]')?.value;

            if (!judul || !isi) {
                e.preventDefault();
                if (errorMessage) {
                    errorMessage.textContent = 'Judul dan isi harus diisi.';
                    errorMessage.style.display = 'block';
                    setTimeout(() => {
                        errorMessage.style.display = 'none';
                    }, 3000);
                }
                return;
            }

            const submitBtn = postForm.querySelector('.TombolPosting');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Mengirim...';
            }
        });
    }

    const pengumumanRadio = document.getElementById('pengumuman');
    const blogRadio = document.getElementById('blog');
    const switchElement = document.querySelector('.switch');

    if (pengumumanRadio && blogRadio && switchElement) {
        function updateSwitchState() {
            if (blogRadio.checked) {
                switchElement.classList.add('active');
                switchElement.setAttribute('aria-checked', 'true');
            } else {
                switchElement.classList.remove('active');
                switchElement.setAttribute('aria-checked', 'false');
            }
        }

        updateSwitchState();

        switchElement.addEventListener('click', function(e) {
            e.preventDefault();
            if (pengumumanRadio.checked) {
                blogRadio.checked = true;
            } else {
                pengumumanRadio.checked = true;
            }
            updateSwitchState();
            const changeEvent = new Event('change', { bubbles: true });
            (pengumumanRadio.checked ? pengumumanRadio : blogRadio).dispatchEvent(changeEvent);
        });

        switchElement.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });

        pengumumanRadio.addEventListener('change', updateSwitchState);
        blogRadio.addEventListener('change', updateSwitchState);

        switchElement.setAttribute('tabindex', '0');
        switchElement.setAttribute('role', 'switch');
    }

    const trixEditor = document.querySelector('trix-editor[input="isi"], trix-editor[input="isi_trix"]');
    if (trixEditor) {
        trixEditor.addEventListener('trix-change', function() {
            const inputId = this.getAttribute('input');
            document.getElementById(inputId).value = this.innerHTML;
        });
    }

    const successMessages = document.querySelectorAll('.alert-success, .PsnBerhasil');
    successMessages.forEach(message => {
        setTimeout(() => {
            message.style.opacity = '0';
            message.style.transition = 'opacity 0.5s ease-out';
            setTimeout(() => {
                message.style.display = 'none';
            }, 500);
        }, 3000);
    });

    const postPreviews = document.querySelectorAll('.mini-post-preview');
    postPreviews.forEach(preview => {
        preview.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 8px 15px rgba(0,0,0,0.1)';
        });
        preview.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 2px 5px rgba(0,0,0,0.1)';
        });
    });

    const closeBtn = document.getElementById('MenutupPreview');
    if (closeBtn) {
        closeBtn.addEventListener('click', e => {
            e.preventDefault();
            const fileInput = document.getElementById('lampiran');
            if (fileInput) fileInput.value = '';
            resetPostPreview();
        });
    }

    const roleSelect = document.getElementById('UserUntuk');
    const muridFields = document.getElementById('FormUntukMurid');
    const guruFields = document.getElementById('FormUntukGuru');
    const TanggalLahir = document.getElementById("tanggal_lahir");
    const TanggalLahirOrtu = document.getElementById("ortu_tanggal_lahir");

    function validateYear(input) {
        if (input) {
            input.addEventListener("change", function () {
                const dateValue = this.value;
                const year = dateValue.split("-")[0];
                if (year.length > 4) {
                    alert("Tahun tidak boleh lebih dari 4 digit, bre!");
                    this.value = "";
                }
            });
        }
    }

    validateYear(TanggalLahir);
    validateYear(TanggalLahirOrtu);

    function toggleFields() {
        if (roleSelect && muridFields && guruFields) {
            const selectedRole = roleSelect.value;
            muridFields.style.display = selectedRole === 'murid' ? 'block' : 'none';
            guruFields.style.display = selectedRole === 'guru' ? 'block' : 'none';
        }
    }

    if (roleSelect) {
        toggleFields();
        roleSelect.addEventListener('change', toggleFields);
    }

    document.querySelectorAll(".NomorOnly").forEach(function (input) {
        input.addEventListener("input", function () {
            let value = this.value;
            if (value.startsWith("+")) {
                value = "+" + value.substring(1).replace(/[^0-9]/g, "");
            } else {
                value = value.replace(/[^0-9]/g, "");
            }
            this.value = value;
        });
    });

    function setupClearButton(inputId, buttonId) {
        const input = document.getElementById(inputId);
        const clearBtn = document.getElementById(buttonId);
        
        if (!input || !clearBtn) return;
        
        function toggleClearButton() {
            clearBtn.style.display = input.value.trim() !== "" ? "inline-block" : "none";
        }

        input.addEventListener("input", toggleClearButton);

        clearBtn.addEventListener("click", function () {
            input.value = "";
            toggleClearButton();
            input.focus();
        });

        toggleClearButton();
    }

    setupClearButton("name", "clearName");
    setupClearButton("email", "clearEmail");
    setupClearButton("alamat", "clearAlamat");
    setupClearButton("jenis_kelamin", "clearJenisKelamin");
    setupClearButton("tanggal_lahir", "clearTanggalLahir");
    setupClearButton("tempat_lahir", "clearTempatLahir");
    setupClearButton("pendidikan", "clearPendidikan");
    setupClearButton("no_telp", "clearNoTelp");
    setupClearButton("password", "clearPassword");
    setupClearButton("UserUntuk", "clearRole");
    setupClearButton("asal_sekolah", "clearAsalSekolah");
    setupClearButton("nis", "clearNis");
    setupClearButton("nisn", "clearNisn");
    setupClearButton("kelas_id", "clearKelasId");
    setupClearButton("ortu_name", "clearOrtuName");
    setupClearButton("ortu_email", "clearOrtuEmail");
    setupClearButton("ortu_alamat", "clearOrtuAlamat");
    setupClearButton("ortu_jenis_kelamin", "clearOrtuJenisKelamin");
    setupClearButton("ortu_tempat_lahir", "clearOrtuTempatLahir");
    setupClearButton("ortu_tanggal_lahir", "clearOrtuTanggalLahir");
    setupClearButton("ortu_profesi", "clearOrtuProfesi");
    setupClearButton("ortu_pendidikan", "clearOrtuPendidikan");
    setupClearButton("ortu_no_telp", "clearOrtuNoTelp");
    setupClearButton("ortu_password", "clearOrtuPassword");
    setupClearButton("gelar", "clearGelar");
    setupClearButton("nuptk", "clearNuptk");
    setupClearButton("statusMenikah", "clearStatusMenikah");
    setupClearButton("statusKerja", "clearStatusKerja");
    setupClearButton("namaPelajaran", "clearNamaPelajaran");
    setupClearButton("nama_kelas", "clearNamaKelas");

    function switchTab(tabName) { 
        const tabContents = document.querySelectorAll('.DisSwitchKelas');
        tabContents.forEach(content => content.classList.remove('active'));
        const tabButtons = document.querySelectorAll('.SwitchKelasTab');
        tabButtons.forEach(button => button.classList.remove('active'));
        
        if (tabName === 'manajemen') {
            document.getElementById('manajemenTab')?.classList.add('active');
            document.getElementById('tabManajemen')?.classList.add('active');
        } else if (tabName === 'kenaikan') {
            document.getElementById('kenaikanTab')?.classList.add('active');
            document.getElementById('tabKenaikan')?.classList.add('active');
        }
    }

    const tabManajemenBtn = document.getElementById('tabManajemen');
    const tabKenaikanBtn = document.getElementById('tabKenaikan');
    
    if (tabManajemenBtn) {
        tabManajemenBtn.addEventListener('click', function(e) {
            e.preventDefault();
            switchTab('manajemen');
        });
    }
    
    if (tabKenaikanBtn) {
        tabKenaikanBtn.addEventListener('click', function(e) {
            e.preventDefault();
            switchTab('kenaikan');
        });
    }

    const handleSuccessMessages = () => {
        const successMessages = document.querySelectorAll('.alert-success, .PsnBerhasil');
        successMessages.forEach(message => {
            setTimeout(() => {
                message.style.opacity = '0';
                message.style.transition = 'opacity 0.5s ease-out';
                setTimeout(() => {
                    message.style.display = 'none';
                }, 500);
            }, 3000);
        });
    };
    
    const handlePostPreviews = () => {
        const postPreviews = document.querySelectorAll('.mini-post-preview');
        postPreviews.forEach(preview => {
            preview.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 8px 15px rgba(0,0,0,0.1)';
            });
            preview.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 2px 5px rgba(0,0,0,0.1)';
            });
        });
    };

    handleSuccessMessages();
    handlePostPreviews();
    handleDeleteConfirmations();
    
    document.addEventListener('livewire:load', function() {
        Livewire.hook('message.processed', (message, component) => {
            handleDeleteConfirmations();
            handleSuccessMessages();
            handlePostPreviews();
            initializeDisplay();
            initializePostManagement();
        });
    });

    function handleDeleteConfirmations() {
        const deleteForms = document.querySelectorAll('.delete-post-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin menghapus postingan ini?')) {
                    form.submit();
                }
            });
        });
    }

    const clearNamaKelasBtn = document.getElementById('clearNamaKelas');
    const namaKelasInput = document.getElementById('querySelector');
    
    if (clearNamaKelasBtn && namaKelasInput) {
        clearNamaKelasBtn.addEventListener('click', function() {
            namaKelasInput.value = '';
            namaKelasInput.focus();
        });
    }

    // Initialize all components
    initializePostManagement();
    initializeTrixEditor();
    initializePostTypeToggle();
});