package es.garchypielago.dwes;
import net.datafaker.Faker;

public class Main {
    public static void main(String[] args) {
        Faker faker = new Faker();

        String cosas = faker.finalFantasyXIV().character();

        System.out.printf(cosas);

    }
}