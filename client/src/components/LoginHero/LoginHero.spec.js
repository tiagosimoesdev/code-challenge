import { mount } from '@vue/test-utils';
import LoginHero from './LoginHero.vue';
import { useAuth0 } from "@auth0/auth0-vue";
jest.mock('@auth0/auth0-vue', () => ({
    useAuth0: jest.fn()
}));

describe('Login Hero', () => {
    it('renders correctly when not logged in', () => {
        // Mock loginWithRedirect function
        const loginWithRedirectMock = jest.fn();
        useAuth0.mockReturnValueOnce({
            loginWithRedirect: loginWithRedirectMock
        });

        const wrapper = mount(LoginHero);

        expect(wrapper.find('h2').text()).toBe('You are NOT logged in');
        expect(wrapper.find('p').text()).toBe('Login to see all the countries');

        wrapper.find('a').trigger('click');

        expect(loginWithRedirectMock).toHaveBeenCalled();
    });
});