document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.InputCari');
    const tableRows = document.querySelectorAll('.TabelNilai tbody tr');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        tableRows.forEach(row => {
            const nameCell = row.querySelector('td:first-child');
            const name = nameCell.textContent.toLowerCase();
            
            if (name.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});