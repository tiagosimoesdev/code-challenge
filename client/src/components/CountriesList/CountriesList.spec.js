import { mount } from '@vue/test-utils';
import CountriesList from './CountriesList.vue';
import { getAllCountries } from '@/services/country.service';

jest.mock('@/services/country.service', () => ({
    getAllCountries: jest.fn()
}));

jest.mock('@auth0/auth0-vue', () => ({
    withAuthenticationRequired: ((component, _) => component),
    useAuth0: () => {
        return {
            isLoading: false,
            user: { sub: "foobar" },
            isAuthenticated: true,
            loginWithRedirect: jest.fn(),
            getAccessTokenSilently: jest.fn()
        }
    }
}));
describe('CountriesList', () => {

    it('renders correctly with country data', async () => {
        // Mock the response from getAllCountries
        const mockedCountries = [
            { name: 'Country1', flag: 'url1' },
            { name: 'Country2', flag: 'url2' },
            { name: 'Country3', flag: 'url3' },
        ];
        getAllCountries.mockResolvedValueOnce({ data: mockedCountries });

        const wrapper = mount(CountriesList);

        await wrapper.vm.$nextTick();

        expect(wrapper.find('[data-test="page-title"]').text()).toBe('List of all the countries');

        const countryList = wrapper.findAll('[data-test="list"]');

        countryList.forEach((country) => {
            const countryName = country.find('[data-test="country-name"]');
            const countryImage = country.find('img');

            expect(countryName.exists()).toBe(true);
            expect(countryImage.exists()).toBe(true);
        });

    });

});