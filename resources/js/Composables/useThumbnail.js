import {faker} from "@faker-js/faker/locale/en";

export function useThumbnail() {
    return {
        generateThumbnail: () => faker.image.abstract(600, 200, true)
    };
};
