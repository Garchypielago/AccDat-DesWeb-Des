package es.garchypielago.dwes;

import net.datafaker.Faker;

import java.util.Locale;
import java.util.Random;

//TIP To <b>Run</b> code, press <shortcut actionId="Run"/> or
// click the <icon src="AllIcons.Actions.Execute"/> icon in the gutter.
public class Main {

    public static void main(String[] args) {
        Faker faker = new Faker();

        System.out.println(faker.breakingBad().character());
        System.out.println(faker.breakingBad().character());


        Faker faker2 = new Faker(new Random(10));
        System.out.println(faker2.breakingBad().character());
        System.out.println(faker2.breakingBad().character());


        Faker faker3 = new Faker(new Locale("es", "ES"));
        System.out.println(faker3.breakingBad().character());
        System.out.println(faker3.breakingBad().character());


        Faker faker4 = new Faker(new Locale("es", "ES"), new Random(10));
        System.out.println(faker4.name().fullName());
        System.out.println(faker4.name().fullName());


    }
}