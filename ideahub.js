document.addEventListener('DOMContentLoaded', function() {
    const ideaForm = document.querySelector('.idea-sharing form');
    const ideaTitleInput = document.querySelector('.idea-sharing form input[type="text"]');
    const ideaDescriptionInput = document.querySelector('.idea-sharing form textarea');
    const skillsRequiredInput = document.querySelector('.idea-sharing form input[type="text"][placeholder="Skills Needed (comma-separated)"]');
    const ideasContainer = document.querySelector('.ideas .idea-container');
    const joinIdeaModal = document.getElementById('joinIdeaModal');
    const joinIdeaForm = document.getElementById('joinIdeaForm');

    function saveIdeasToLocalStorage(ideas) {
        localStorage.setItem('ideas', JSON.stringify(ideas));
    }

    function getIdeasFromLocalStorage() {
        const storedIdeas = localStorage.getItem('ideas');
        return storedIdeas ? JSON.parse(storedIdeas) : [];
    }

    function renderIdeasFromLocalStorage() {
        const ideas = getIdeasFromLocalStorage();
        ideasContainer.innerHTML = ''; // Clear existing ideas
        ideas.forEach(function(idea, index) {
            const ideaCard = createIdeaCard(idea.title, idea.description, idea.skills, index);
            ideasContainer.appendChild(ideaCard);
        });
    }

    function createIdeaCard(title, description, skills, index) {
        const ideaCard = document.createElement('div');
        ideaCard.classList.add('idea-card');
        ideaCard.innerHTML = `
            <h3 style="font-weight:bold;">${title}</h3>
            <p>${description}</p>
            <p>Skills Needed: ${skills}</p>
            <button class="join-idea-btn">Join Idea</button>
            <button class="delete-idea-btn" data-index="${index}">Delete Idea</button>
        `;
        return ideaCard;
    }

    renderIdeasFromLocalStorage();

    ideaForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const ideaTitle = ideaTitleInput.value;
        const ideaDescription = ideaDescriptionInput.value;
        const skillsRequired = skillsRequiredInput.value;

        if (ideaTitle.trim() !== '') {
            const idea = {
                title: ideaTitle,
                description: ideaDescription,
                skills: skillsRequired
            };

            const ideaCard = createIdeaCard(idea.title, idea.description, idea.skills);
            ideasContainer.appendChild(ideaCard);

            const ideas = getIdeasFromLocalStorage();
            ideas.push(idea);
            saveIdeasToLocalStorage(ideas);

            ideaForm.reset();
        } else {
            alert('Please enter an idea title.');
        }
    });

    ideasContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-idea-btn')) {
            const index = event.target.dataset.index;
            deleteIdea(index);
        } else if (event.target.classList.contains('join-idea-btn')) {
            joinIdeaModal.style.display = 'block';
        }
    });

    joinIdeaForm.addEventListener('submit', function(event) {
        event.preventDefault();
        // Get form values
        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;
        const email = document.getElementById('email').value;
        const languages = document.getElementById('languages').value;

        // Do something with the form data (e.g., send a request to the server)

        // Display success notification
        alert('Request sent successfully!');

        // Close the modal
        joinIdeaModal.style.display = 'none';

        // Clear form fields
        joinIdeaForm.reset();
    });

    // Close the modal when clicking on the close button
    document.querySelector('.close').addEventListener('click', function() {
        joinIdeaModal.style.display = 'none';
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === joinIdeaModal) {
            joinIdeaModal.style.display = 'none';
        }
    });

    function deleteIdea(index) {
        const ideas = getIdeasFromLocalStorage();
        ideas.splice(index, 1);
        saveIdeasToLocalStorage(ideas);
        renderIdeasFromLocalStorage();
    }
});
