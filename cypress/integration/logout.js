it('Logs out users', () => {
    cy.create('App\\Models\\User').then(user => {
        cy.visit('/login');
        // login
        cy.userLogin(user);

        cy.location('pathname').should('eq', '/');

        cy.get('div[id="manage_profile_icon"]').should('be.visible', { timeout: 5000 });

        // logout
        cy.get('div[id="manage_profile_icon"]').click();
        cy.contains(user.first_name);
        cy.get('a[id="dropdown_logout"]').click();

        cy.location('pathname').should('eq', '/login');


    });
});
