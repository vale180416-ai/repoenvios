<?php include 'conexion.php'; ?>
                            <td class="px-6 py-5 font-bold text-pink-300">
                                #<?php echo $row['id']; ?>
                            </td>

                            <td class="px-6 py-5 font-semibold">
                                <?php echo $row['destinatario']; ?>
                            </td>

                            <td class="px-6 py-5 text-gray-300">
                                <?php echo $row['direccion']; ?>
                            </td>

                            <td class="px-6 py-5 text-gray-400">
                                <?php echo $row['descripcion']; ?>
                            </td>

                            <td class="px-6 py-5 text-center">

                                <?php if(!empty($row['imagen'])) { ?>

                                    <img
                                    src="imagenes/<?php echo $row['imagen']; ?>"
                                    class="w-20 h-20 object-cover rounded-2xl mx-auto border border-pink-400/30 shadow-lg">

                                <?php } else { ?>

                                    <span class="text-gray-500">
                                        Sin imagen
                                    </span>

                                <?php } ?>

                            </td>

                            <td class="px-6 py-5 text-center">

                                <a href="editar.php?id=<?php echo $row['id']; ?>"
                                class="bg-green-500 hover:bg-green-600 px-4 py-3 rounded-xl mx-1 inline-block transition shadow-lg">

                                    <i class="fas fa-edit"></i>

                                </a>


                                <a href="eliminar.php?id=<?php echo $row['id']; ?>"
                                onclick="return confirm('¿Eliminar envío?')"
                                class="bg-red-500 hover:bg-red-600 px-4 py-3 rounded-xl mx-1 inline-block transition shadow-lg">

                                    <i class="fas fa-trash"></i>

                                </a>

                            </td>

                        </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>


    <!-- FOOTER -->
    <footer class="relative z-10 border-t border-cyan-500/10 py-6 text-center text-gray-500 text-sm">

        © <?php echo date('Y'); ?> ENVI GIRL | Plataforma Inteligente de Gestión

    </footer>

</body>
</html>