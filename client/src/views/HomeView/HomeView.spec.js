import { shallowMount } from '@vue/test-utils';
import HomeView from './HomeView.vue';
import LoginHero from '@/components/LoginHero/LoginHero.vue';
import CountriesList from '@/components/CountriesList/CountriesList.vue';

jest.mock('@auth0/auth0-vue', () => ({
  withAuthenticationRequired: ((component, _) => component),
  useAuth0: () => {
    return {
      isLoading: false,
      user: { sub: "foobar" },
      isAuthenticated: false,
      loginWithRedirect: jest.fn()
    }
  }
}));

describe('Logged Out', () => {
  it('renders LoginHero when not authenticated', async () => {

    const wrapper = shallowMount(HomeView);

    await wrapper.vm.$nextTick();

    expect(wrapper.findComponent(LoginHero).exists()).toBe(true);
    expect(wrapper.findComponent(CountriesList).exists()).toBe(false);
  });

});
