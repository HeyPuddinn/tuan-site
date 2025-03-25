// Custom cursor implementation
document.addEventListener('DOMContentLoaded', function() {
    // Create cursor element
    console.log('Custom cursor implementation');
    const cursor = document.createElement('div');
    cursor.classList.add('custom-cursor');
    document.body.appendChild(cursor);

    // Update cursor position
    document.addEventListener('mousemove', (e) => {
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
    });

    // Add hover effect for all interactive elements
    document.querySelectorAll(`
        a, 
        button, 
        input, 
        textarea, 
        select,
        [role="button"],
        [role="link"],
        [role="tab"],
        [role="menuitem"],
        .swiper-slide,
        .clickable,
        .draggable,
        [onclick],
        [data-clickable="true"],
        label[for],
        details summary,
        .cursor-pointer,
        video:not([disabled]),
        audio:not([disabled]),
        [contenteditable="true"]
    `).forEach(element => {
        element.addEventListener('mouseenter', () => {
            cursor.classList.add('cursor-hover');
        });
        
        element.addEventListener('mouseleave', () => {
            cursor.classList.remove('cursor-hover');
        });
    });
});
