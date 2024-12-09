package es.garchypielago.dwes.ejemplo03web.repositories.base;

public interface Repository<T,ID> {
    T findById(ID id);
}
